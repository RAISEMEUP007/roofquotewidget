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
        var scriptUrl = document.getElementById('widget-script-url').value;
     
        var scriptElement = el('script', {
          src: scriptUrl,
          async: true,
        });
        
        return el(
              'div',
              { className: 'my-block' },
              "",
              scriptElement // Append the <script> element to the block content
          );
      },
  });
})(
  window.wp.blocks,
  window.wp.element
);