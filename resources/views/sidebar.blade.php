<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 60px;
            height: 100vh;
            z-index: 9999;
        }

        .sidebar {
            background-color: #333;
            transition: width 0.3s;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar-arrow {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-color: #ccc;
            cursor: pointer;
        }

        .sidebar-expanded {
            width: 200px;
        }

        .forum-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: none;

            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
        }

        .forum-list li {
            padding: 10px;
            text-align: center;
        }

        .forum-list li a {
            text-decoration: none;
            color: #fff;
        }

        .content {
            margin-left: 60px;
            padding: 20px;
        }


        .push-content {
            margin-left: 60px;
        }


        .sidebar-expanded .forum-list {
            display: block;
        }


        .sidebar-expanded h2 {
            display: block;
        }

        .sidebar h2 {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar-container">
            <div class="sidebar" id="sidebar">
                <div class="sidebar-arrow" id="sidebar-arrow"></div>
                <h2>Forums You Have Joined</h2>
                <ul class="forum-list" id="forum-list">
                    @foreach ($user->forums as $forum)
                    <li><a href="{{ route('forums.show', ['name' => $forum->name]) }}">{{ $forum->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <script>
        const sidebar = document.querySelector('#sidebar');
        const sidebarArrow = document.querySelector('#sidebar-arrow');
        const forumList = document.querySelector('#forum-list');
        let isSidebarExpanded = false;

        // Add event listener to the arrow for expanding/collapsing the sidebar
        sidebarArrow.addEventListener('click', function() {
            isSidebarExpanded = !isSidebarExpanded; // Toggle the sidebar state
            sidebar.classList.toggle('sidebar-expanded');
        });
    </script>
</body>