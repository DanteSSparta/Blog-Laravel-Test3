
      <div class="blog-masthead">
        <div class="container">
          <nav class="nav">
            <a class="nav-link active" href="/">Home</a>

            
                <!-- Authentication Links -->
                @guest
                      <a class="nav-link ml-auto" href="/login">Login</a>
                      <li><a class="nav-link ml-auto" href="/register">Register</a></li>
                    
                @else
                    <a class="nav-link" href="/posts/create">Create Post</a>
                    <a class="nav-link ml-auto" href="#">{{Auth::user()->name}}</a>
                    <li><a class="nav-link ml-auto" href="/logout">Logout</a></li>
                @endguest
                
          </nav>
        </div>
      </div>

    