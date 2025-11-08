  <?php if (IS_VITE_DEVELOPMENT): ?>
    <footer>
      <div class="fixed bottom-4 right-0 mx-auto flex items-center justify-center px-4">
        <div class="flex items-center gap-1.5 rounded-full border border-blue-500/50 bg-blue-600/20 px-3 py-1.5">
          <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-blue-500"></span>
          <strong class="text-blue-400 font-semibold text-xs">Dev</strong>
        </div>
      </div>
    </footer>
  <?php endif; ?>

  <?php wp_footer(); ?>
  </body>

  </html>