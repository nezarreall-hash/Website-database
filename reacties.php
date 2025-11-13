<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reacties</title>
</head>
<body>
<style>
    :root{
      --bg:#f6f7fb; --card:#ffffff; --muted:#6b7280; --accent:#2563eb;
      --radius:10px; --gap:12px; font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    body{
      margin:0; background:var(--bg); color:#111827; padding:28px;
      display:flex; justify-content:center;
      font-size:16px;
    }
    .wrap{
      width:100%; max-width:760px;
    }
    header{margin-bottom:18px}
    h1{font-size:20px; margin:0 0 6px}
    p.lead{margin:0; color:var(--muted); font-size:14px}

    .card{
      background:var(--card); border-radius:var(--radius);
      padding:16px; box-shadow:0 6px 18px rgba(15,23,42,0.06); margin-bottom:16px;
    }

    form.add-comment{
      display:flex; gap:12px; align-items:flex-start;
    }
    textarea{
      flex:1; min-height:70px; resize:vertical; padding:10px; border-radius:8px;
      border:1px solid #e6e9ef; font-size:15px; font-family:inherit;
    }
    button.primary{
      background:var(--accent); color:white; border:none; padding:10px 14px; border-radius:8px;
      cursor:pointer; font-weight:600;
    }
    button.primary:disabled{opacity:.6; cursor:not-allowed}

    .comments-list{display:flex; flex-direction:column; gap:10px; margin-top:10px}
    .comment{
      display:flex; gap:12px; align-items:flex-start; padding:10px; border-radius:8px;
      border:1px solid #eef2ff; background:linear-gradient(180deg, rgba(255,255,255,0.7), rgba(250,250,255,0.7));
    }
    .avatar{
      flex:0 0 44px; width:44px; height:44px; border-radius:50%;
      background:linear-gradient(135deg,#eef2ff,#fff); display:flex; align-items:center; justify-content:center;
      color:var(--muted); font-weight:700;
    }
    .comment-body{flex:1}
    .meta{display:flex; justify-content:space-between; gap:12px; align-items:center}
    .author{font-weight:700}
    .time{color:var(--muted); font-size:13px}
    .text{margin:6px 0 8px; white-space:pre-wrap}
    .actions{display:flex; gap:8px; align-items:center}
    .like-btn{
      display:inline-flex; gap:8px; align-items:center; padding:6px 10px; border-radius:8px; border:1px solid #e5e7eb;
      background:white; cursor:pointer; font-weight:600; font-size:14px;
    }
    .like-btn.liked{border-color:rgba(37,99,235,0.18); background:rgba(37,99,235,0.06); color:var(--accent)}
    .count{font-weight:700; min-width:26px; text-align:center}
    small.hint{display:block; color:var(--muted); margin-top:8px}
    @media (max-width:560px){
      form.add-comment{flex-direction:column}
      .avatar{display:none}
    }
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <h1>Reacties</h1>
    </header>

    <section class="card" aria-labelledby="add-comment-heading">
      <h2 id="add-comment-heading" style="font-size:15px;margin:0 0 8px">Voeg een reactie toe</h2>
      <form id="commentForm" class="add-comment" autocomplete="off">
        <textarea id="commentText" placeholder="Voer je reactie in...." required aria-label="Comment text"></textarea>
        <div style="display:flex;flex-direction:column;gap:8px">
          <input id="displayName" placeholder="Jou naam" style="padding:8px;border-radius:8px;border:1px solid #e6e9ef" />
          <button class="primary" id="submitBtn" type="submit">Post</button>
        </div>
      </form>
    </section>

    <section class="card" aria-live="polite" aria-labelledby="comments-heading">
      <h2 id="comments-heading" style="font-size:15px;margin:0 0 8px">Comments</h2>
      <div id="commentsList" class="comments-list" role="list"></div>
      <p id="emptyHint" style="color:var(--muted); margin-top:10px">No comments yet — be the first!</p>
    </section>
  </div>

  <script>
  (function(){
    const STORAGE_KEY = 'reactions.comments.v1';
    const LIKED_KEY = 'reactions.likedIds.v1';
    const form = document.getElementById('commentForm');
    const textEl = document.getElementById('commentText');
    const nameEl = document.getElementById('displayName');
    const listEl = document.getElementById('commentsList');
    const emptyHint = document.getElementById('emptyHint');

    function loadComments(){
      try{
        const raw = localStorage.getItem(STORAGE_KEY);
        return raw ? JSON.parse(raw) : [];
      }catch(e){
        console.error('Failed to parse comments storage', e);
        return [];
      }
    }
    function saveComments(comments){
      localStorage.setItem(STORAGE_KEY, JSON.stringify(comments));
    }
    function loadLikedSet(){
      try{
        const raw = localStorage.getItem(LIKED_KEY);
        return raw ? new Set(JSON.parse(raw)) : new Set();
      }catch(e){
        return new Set();
      }
    }
    function saveLikedSet(set){
      localStorage.setItem(LIKED_KEY, JSON.stringify(Array.from(set)));
    }
    function makeId(){
      return Date.now().toString(36) + '-' + Math.random().toString(36).slice(2,9);
    }
    function timeAgo(ts){
      const s = Math.floor((Date.now() - ts)/1000);
      if(s < 10) return 'just now';
      if(s < 60) return s + 's';
      const m = Math.floor(s/60);
      if(m < 60) return m + 'm';
      const h = Math.floor(m/60);
      if(h < 24) return h + 'h';
      const d = Math.floor(h/24);
      return d + 'd';
    }
    function avatarLetter(name){
      if(!name) return 'U';
      return name.trim().slice(0,1).toUpperCase();
    }

    function render(){
      const comments = loadComments();
      const liked = loadLikedSet();
      listEl.innerHTML = '';
      if(comments.length === 0){
        emptyHint.style.display = 'block';
        return;
      }
      emptyHint.style.display = 'none';

      comments.slice().reverse().forEach(c => {
        const item = document.createElement('div');
        item.className = 'comment';
        item.setAttribute('data-id', c.id);
        item.setAttribute('role','listitem');

        item.innerHTML = `
          <div class="avatar" aria-hidden="true">${avatarLetter(c.name)}</div>
          <div class="comment-body">
            <div class="meta">
              <div>
                <div class="author">${c.name || 'Anonymous'}</div>
                <div class="time" title="${new Date(c.ts).toLocaleString()}">${timeAgo(c.ts)}</div>
              </div>
              <div class="actions">
                <button class="like-btn" aria-pressed="false" type="button">
                  <span class="icon" aria-hidden="true">👍</span>
                  <span class="count">${c.likes}</span>
                </button>
              </div>
            </div>
            <div class="text">${escapeHtml(c.text)}</div>
          </div>
        `;

        const likeBtn = item.querySelector('.like-btn');
        const countSpan = item.querySelector('.count');

        if(liked.has(c.id)){
          likeBtn.classList.add('liked');
          likeBtn.setAttribute('aria-pressed','true');
        }

        likeBtn.addEventListener('click', () => {
          const likedSet = loadLikedSet();
          const comments = loadComments();
          const idx = comments.findIndex(x => x.id === c.id);
          if(idx === -1) return;

          if(likedSet.has(c.id)){
            likedSet.delete(c.id);
            comments[idx].likes = Math.max(0, comments[idx].likes - 1);
          } else {
            likedSet.add(c.id);
            comments[idx].likes = (comments[idx].likes || 0) + 1;
          }
          saveLikedSet(likedSet);
          saveComments(comments);
          countSpan.textContent = comments[idx].likes;
          likeBtn.classList.toggle('liked');
          likeBtn.setAttribute('aria-pressed', likeBtn.classList.contains('liked').toString());
        });

        listEl.appendChild(item);
      });
    }

    function escapeHtml(s){
      return (s || '')
        .replaceAll('&','&amp;')
        .replaceAll('<','&lt;')
        .replaceAll('>','&gt;')
        .replaceAll('"','&quot;')
        .replaceAll("'","&#39;");
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const text = textEl.value.trim();
      if(!text) return;
      const name = nameEl.value.trim();
      const comments = loadComments();
      const newComment = {
        id: makeId(),
        name: name || 'Anonymous',
        text,
        likes: 0,
        ts: Date.now()
      };
      comments.push(newComment);
      saveComments(comments);
      textEl.value = '';
      render();
      textEl.focus();
    });

    textEl.addEventListener('keydown', (e) => {
      if((e.ctrlKey || e.metaKey) && e.key === 'Enter'){
        form.requestSubmit();
      }
    });

    (function seed(){
      const comments = loadComments();
      if(comments.length === 0){
        const sample = [{
          id: makeId(),
          name: 'Site',
          text: 'Welcome! Add a comment and click the 👍 to like it.',
          likes: 0,
          ts: Date.now() - 1000 * 60 * 60
        }];
        saveComments(sample);
      }
    })();

    render();

    window.addEventListener('storage', (e) => {
      if(e.key === STORAGE_KEY || e.key === LIKED_KEY) render();
    });

  })();
  </script>
</body>
</html>


