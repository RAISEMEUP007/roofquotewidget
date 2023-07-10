(function (blocks, element) {
  var el = element.createElement;
  var registerBlockType = blocks.registerBlockType;

  registerBlockType('my-custom-block/my-block', {
      title: 'Roof Quote Pro',
      icon: 'admin-site',
      edit: function () {
    
          return el(
            'div',
            { className: 'my-block' },
            'Roof Quote Pro'
          );
      },
      save: function () {
        var scriptElement = el('script', {
          src: 'https://app.roofle.com/roof-quote-pro-embedded-widget.js?id='+encodeURIComponent(widgetId),
          async: true,
        });
          return el(
              'div',
              { className: 'my-block' },
              'Roof Quote Pro',
              scriptElement // Append the <script> element to the block content
          );
      },
  });
})(
  window.wp.blocks,
  window.wp.element
);