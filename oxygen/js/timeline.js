$('#example').timeliny({

  // or 'desc'
  order: 'asc',

  // classname for the timeline
  className: 'timeliny',

  // timeline wrapper
  wrapper: '<div class="timeliny-wrapper"></div>',

  // boundaries
  boundaries: 2,

  // animation speed in ms
  animationSpeed: 250,

  // hides blank years
  hideBlankYears: false,

  // callbacks
  onInit: function() {},
  onDestroy: function() {},
  afterLoad: function(currYear) {},
  onLeave: function(currYear, nextYear) {},
  afterChange: function(currYear) {},
  afterResize: function() {}

});
