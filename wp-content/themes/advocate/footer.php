<footer>
  <div class="container">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget One')) : ?>
    <?php endif; ?>
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Two')) : ?>
    <?php endif; ?>
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Three')) : ?>
    <?php endif; ?>
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Four')) : ?>
    <?php endif; ?>
    <div class="clear"></div>
    <div class="copy"><p>&copy;2015 SEPC</p></div>
  </div>
  <?php wp_footer(); ?>
</footer>
</body>
</html>