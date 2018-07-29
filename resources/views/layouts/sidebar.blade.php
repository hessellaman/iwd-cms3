  <div class="col-sm-3 offset-sm-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <h4>About</h4>
      <p><em>Tech-Zone</em> is het meest toonaangevende blog van Nederland op het gebied van technologie. Het blog wordt onderhouden door geniale Informatiekunde student Hessel Laman en zijn collega's.</p>
    </div>
    <!-- Toon de maand en het jaar van alle posts die bekend zijn in de database -->
    <div class="sidebar-module">
      <h4>Archives</h4>
      <ol class="list-unstyled">
        @foreach ($archives as $stats )
          <li>
            <a href="/blog/?month={{ $stats['month'] }}&year={{ $stats['year'] }}">
              {{ $stats['month'] . ' ' . $stats['year'] }}
            </a>
          </li>
        @endforeach
      </ol>
    </div>
    <!-- Toon alle tags die gekoppeld zijn een bepaalde posts in de database -->
    <div class="sidebar-module">
      <h4>Tags</h4>
      <ol class="list-unstyled">
        @foreach ($tags as $tag )
          <li>
            <a href="/blog/tags/{{ $tag }}">
              {{ $tag }}
            </a>
          </li>
        @endforeach
      </ol>
    </div>

    <div class="sidebar-module">
      <h4>Elsewhere</h4>
      <ol class="list-unstyled">
        <li><a href="#">GitHub</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Facebook</a></li>
      </ol>
    </div>
  </div><!-- /.blog-sidebar -->
  