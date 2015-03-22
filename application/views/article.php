<div class="wrap breadcrumb-wrap">
  <div class="wrap-center">
    <ul class="breadcrumb">
      <?php breadcrumb($breadcrumb); ?>
    </ul>
  </div>
</div>
<div class="wrap">
  <div class="wrap-center">
    <div id='wrap-post-news'>
      <div class="post_news">
        <div class="title_news"><h2><?=$current_article->title?></h2><span style="font-size:12px; margin: 15px 0 0 0;"><?php echo date_rus($current_article->date); ?></span></div>
        <div class="content_news"><?=$current_article->text?></div>
      </div>
    </div><div class="cleaner"></div>
    <!-- Put this script tag to the <head> of your page -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?87"></script>

    <script type="text/javascript">
      VK.init({apiId: 3553876, onlyWidgets: true});
    </script>
    <!-- Put this div tag to the place, where the Comments block will be -->
    <div id="vk_comments"></div>
    <script type="text/javascript">
      VK.Widgets.Comments("vk_comments", {limit: 10, width: "930", attach: "*"});
    </script>
  </div>
</div>