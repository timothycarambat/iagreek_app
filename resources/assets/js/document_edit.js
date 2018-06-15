$(function(){ if(window.view === "document_edit"){

  var toolbarOptions = [
    [{ 'font': [] }],
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

    [{ 'align': [] }],
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript

    ['name','date'],
  ];

  var quill = new Quill('.editor', {
    modules: {
      'history': {          // Enable with custom configurations
       'delay': 2500,
       'userOnly': true
       },
       toolbar: toolbarOptions,
    },
    placeholder: 'Start Building Your Document Template!',
    theme: 'snow'
  });

  var insertNameBtn = document.querySelector('.ql-name');
  insertNameBtn.addEventListener('click', function() {
    var range = quill.getSelection();
    if (range) {
      quill.insertText(range.index, "<%NAME%>");
    }
  });

  var insertDateBtn = document.querySelector('.ql-date');
  insertDateBtn.addEventListener('click', function() {
    var range = quill.getSelection();
    if (range) {
      quill.insertText(range.index, "<%DATE%>");
    }
  });

  setInterval(function(){saveDocument(quill)},30000);
  $('.save-btn').click(function(){saveDocument(quill)});
}}); //end windowif


function saveDocument(quill){
  let content = quill.container.firstChild.innerHTML;
  $.ajax({
    url: `${window.location.pathname}/save`,
    type: 'POST',
    data: {content: content},
    beforeSend: function(request) {
      request.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
      $('.save-btn').text('Saving...');
    },
    success: function(results){
      $('.save-btn').text('Save');
    }
  })
}
