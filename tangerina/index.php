<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tangerina Dev</title>
<link
  rel="stylesheet"
  href="https://unpkg.com/xp.css"
>
<link rel="stylesheet" href="styles.css">
<meta property="og:title" content="Tangerina Dev">
<meta property="og:description" content="Uma apresentação estilo Desktop">
<meta property="og:image" content="https://nbastian.com/tangerina/ogbk.jpg"> 
<meta property="og:image:width" content="1200"> 
<meta property="og:image:height" content="630"> 
<meta property="og:type" content="website">
<meta property="og:url" content="https://tangerinadev.com"> 

</head>
<body>
<div id="desktop">
  <!-- Apps -->
  <a class="app" href="https://www.homehost.com.br/blog/" >
    <img class="appIcon" src="wp.png" alt="">
    <div class="appName">Abrir<br>WordPress</div>
  </a>
  
  <a class="app" data-app-id="blog">
    <img class="appIcon" src="https://cdn.iconscout.com/icon/free/png-512/free-blogger-1543575-1306078.png" alt="">
    <div class="appName">Blog</div>
  </a>
  
  <a class="app" data-app-id="equipe" onclick="loadPeople">
    <img class="appIcon" src="https://cdn.iconscout.com/icon/free/png-512/free-team-167-459280.png" alt="">
    <div class="appName">Equipe</div>
  </a>
  
  
  <?php
    $appsDirectory = 'apps/';
    $apps = [];

    foreach (scandir($appsDirectory) as $appFolder) {
      if ($appFolder !== '.' && $appFolder !== '..' && is_dir($appsDirectory . $appFolder)) {
        $configPath = $appsDirectory . $appFolder . '/config.json';
        if (file_exists($configPath)) {
          $config = json_decode(file_get_contents($configPath), true);
          $appImagePath = $appsDirectory . $appFolder . '/' . $config['icon'];
          $appTitle = $config['name'];
          $appWidth = isset($config['width']) ? $config['width'] : 300;
          $appHeight = isset($config['height']) ? $config['height'] : 300;
          echo '<a class="app" data-app-id="' . $appFolder . '">';
          echo '<img class="appIcon" src="' . $appsDirectory . $appFolder . '/' . $config['icon'] . '" alt="' . $config['name'] . '">';
          echo '<div class="appName">' . $config['name'] . '</div>';
          echo '</a>';

          echo '<div class="window" id="' . $appFolder . 'Window" style="width: ' . $appWidth . 'px; height: ' . $appHeight . 'px; transform: translate(156px, 10px); position: absolute; top: 0px; left: 0px; display: none;">';
          echo '<div class="title-bar">';
          echo '<div class="title-bar-text">' . $config['name'] . '</div>';
          echo '<div class="title-bar-controls">';
          echo '<button aria-label="Minimize"></button>';
          echo '<button aria-label="Maximize"></button>';
          echo '<button aria-label="Close" class="close-button"></button>';
          echo '</div>';
          echo '</div>';
          echo '<div class="window-body">';
          
          if ($config['type'] === 'php') {
            include $appsDirectory . $appFolder . '/' . $config['main'];
          } else {
            echo file_get_contents($appsDirectory . $appFolder . '/' . $config['main']);
          }
          
          echo '</div>';
          echo '</div>';
        }
      }
    }
    ?>


<div id="bottomBar">
  <div id="startButton" onclick="toggleStartMenu()">Start</div>
  <div id="startMenu">
    <ul>
      <li><a href="#">Program 1</a></li>
      <li><a href="#">Program 2</a></li>
      <li><a href="#">Program 3</a></li>
    </ul>
  </div>
  <div id="clock">12:34 PM</div>
</div>
<script>
    function toggleStartMenu() {
      var startButton = document.getElementById('startButton');
      var startMenu = document.getElementById('startMenu');
      
      startButton.classList.toggle('active');
      startMenu.classList.toggle('active');
    }
</script>
<!-- APP Windows -->

<div class="window" id="blogWindow" style="width: 300px;     
transform: translate(156px, 10px);
position: absolute;
top: 0px;
left: 0px;
display:none;"
>
  <div class="title-bar">
    <div class="title-bar-text">Blog</div>
    <div class="title-bar-controls">
      <button aria-label="Minimize"></button>
      <button aria-label="Maximize"></button>
      <button aria-label="Close" class="close-button"></button>
    </div>
  </div>
  <div class="window-body">
    <ul id="postList" class="explorer-list">
      <!-- List of blog post items will be inserted here dynamically -->
      Carregando blog
    </ul>
    <div id="pagination" class="pagination"></div>
  </div>
</div>

<div class="window" id="postWindow" style="width: 450px;     
transform: translate(304px, 10px);
position: absolute;
top: 0px;
left: 0px;
display:none;
z-index:5;"
>
  <div class="title-bar">
    <div class="title-bar-text">Visualizador</div>
    <div class="title-bar-controls">
      <button aria-label="Minimize"></button>
      <button aria-label="Maximize"></button>
      <button aria-label="Close" class="close-button"></button>
    </div>
  </div>
  <div class="window-body " id="postContent">
    <p>Blog Post</p>
  </div>
</div>

<div class="window" id="equipeWindow" style="width: 300px;     
transform: translate(100px, 40px);
position: absolute;
top: 0px;
left: 0px;
display:none;"
>
  <div class="title-bar">
    <div class="title-bar-text">Equipe</div>
    <div class="title-bar-controls">
      <button aria-label="Minimize"></button>
      <button aria-label="Maximize"></button>
      <button aria-label="Close" class="close-button"></button>
    </div>
  </div>
  <div class="window-body " id="postContent">
    <p>Equipe</p>
    <ul id="teamList" class="explorer-list">
      <!-- List of blog post items will be inserted here dynamically -->
      Carregando equipe
    </ul>
  </div>
</div>
<div id="windowsContainer">

</div>

<script>
  const apps = document.querySelectorAll('.app');
  apps.forEach(app => {
    app.addEventListener('click', (e) => {
      const appId = app.getAttribute('data-app-id');
      const window = document.getElementById(`${appId}Window`);
      if (window) {
        window.style.display = 'block';
      }
    });
  });
</script>

<script>
  const windows = document.querySelectorAll('.window');

  windows.forEach(window => {
    const closeButton = window.querySelector('.close-button');
    const titleBar = window.querySelector('.title-bar');
    let isDragging = false;
    let xOffset, yOffset;
    
    const minX = 0;
    const maxX = window.parentElement.clientWidth - window.clientWidth;
    const minY = 0;
    const maxY = window.parentElement.clientHeight - window.clientHeight;

    titleBar.addEventListener('mousedown', (e) => {
      isDragging = true;
      xOffset = e.clientX - window.getBoundingClientRect().left;
      yOffset = e.clientY - window.getBoundingClientRect().top;
      //window.style.cursor = 'grabbing';
    });

    document.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      let newX = e.clientX - xOffset;
      let newY = e.clientY - yOffset;
      
      // Restrict dragging within the viewport
      newX = Math.max(minX, Math.min(newX, maxX));
      newY = Math.max(minY, Math.min(newY, maxY));

      window.style.transform = `translate(${newX}px, ${newY}px)`;
    });

    document.addEventListener('mouseup', () => {
      isDragging = false;
      //window.style.cursor = 'grab';
    });

    closeButton.addEventListener('click', () => {
      window.style.display = 'none';
    });
  });
</script>
<script>
  const blogWindow = document.getElementById('blogWindow');
  const postWindow = document.getElementById('postWindow');
  const postList = document.getElementById('postList');
  const teamList = document.getElementById('teamList');
  const postContent = document.getElementById('postContent');
  const pagination = document.getElementById('pagination');
  const apiUrl = 'https://www.homehost.com.br/blog/wp-json/wp/v2/posts';
  let currentPage = 1;
  
  // Load posts and pagination dynamically using WordPress API
  function loadPosts(page) {
    fetch(`${apiUrl}?per_page=5&page=${page}`)
      .then(response => response.json())
      .then(posts => {
        console.log(`${apiUrl}?per_page=5&page=${page}`);
        postList.innerHTML = ''; // Clear previous posts
        
        posts.forEach(post => {
          console.log(post);
          const listItem = document.createElement('li');
          listItem.innerHTML = `
            <a href="${post.link}" target="_blank" class="explorer-list-item">
              <div class="explorer-list-icon">
                <img src="https://cdn.iconscout.com/icon/free/png-512/free-blogger-1543575-1306078.png" alt="Icon">
              </div>
              <div class="explorer-list-details">
                <div class="explorer-list-name">${post.title.rendered}</div>
                <div class="explorer-list-info">
                  <span>${post.author}</span>
                  <span>${post.categories.join(', ')}</span>
                  <span>${post.date}</span>
                </div>
              </div>
            </a>
          `;
          console.log(listItem);
          postList.appendChild(listItem);
        });

        // Pagination
        const totalPages = 5;//response.headers.get('X-WP-TotalPages');
        renderPagination(totalPages);
      });
      
  }

  // Render pagination links
  function renderPagination(totalPages) {
    pagination.innerHTML = '';
    for (let page = 1; page <= totalPages; page++) {
      const pageLink = document.createElement('a');
      pageLink.textContent = page;
      pageLink.addEventListener('click', () => {
        currentPage = page;
        loadPosts(currentPage);
      });
      pagination.appendChild(pageLink);
    }
  }
  // Load post content and display the post window
  function loadPostContent(path) {
    fetch(path)
      .then(response => response.text())
      .then(content => {
        postContent.innerHTML = content;
        postWindow.style.display = 'block';
      });
  }
  const equipeApp = document.querySelector('.app[data-app-id="equipe"]');
equipeApp.addEventListener('click', () => {
  loadPeople();
});

function loadPeople() {
  fetch('load_people.php')
    .then(response => response.json())
    .then(data => {
      teamList.innerHTML = ''; // Clear previous content

      data.forEach(person => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `
          <a href="#" class="explorer-list-item">
            <div class="explorer-list-icon">
              <img src="${person.image}" alt="Icon">
            </div>
            <div class="explorer-list-details">
              <div class="explorer-list-name">${person.title}</div>
              <!-- Other details if needed -->
            </div>
          </a>
        `;
        listItem.addEventListener('click', () => loadPersonContent(person.path));
        teamList.appendChild(listItem);
      });

      // Hide other windows and show the "equipe" window
      //hideAllWindows();
      equipeWindow.style.display = 'block';
    });
}

function loadPersonContent(path) {
  fetch(path)
    .then(response => response.text())
    .then(content => {
      postContent.innerHTML = content;
      postWindow.style.display = 'block';
    });
}

  // Initial load
  loadPosts(currentPage);
</script>

</body>
</html>
