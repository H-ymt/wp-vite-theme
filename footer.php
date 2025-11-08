  <?php if (IS_VITE_DEVELOPMENT): ?>
    <footer>
      <div class="mx-auto fixed bottom-4 right-0 px-4 flex items-center justify-center">
        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-600/20 border-blue-500/50 border">
          <span class="w-1.5 rounded-full animate-pulse bg-blue-500 h-1.5"></span>
          <strong class="text-blue-400 font-semibold text-xs">Dev</strong>
        </div>
      </div>
    </footer>
  <?php endif; ?>

  <?php wp_footer(); ?>
  </body>

  </html>