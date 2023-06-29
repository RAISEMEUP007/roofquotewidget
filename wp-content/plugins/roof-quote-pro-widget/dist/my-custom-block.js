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
              'This is my custom block content.'
          );
      },
      save: function () {
          return el(
              'div',
              { className: 'my-block' },
              'This is my custom block content.'
          );
      },
  });
})(
  window.wp.blocks,
  window.wp.element
);