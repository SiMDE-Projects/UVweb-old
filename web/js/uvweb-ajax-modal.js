//Function to display a modal on a click on a delete button: more convenient than redirecting the user for a validation
var ajaxModal = function() {
  $("[data-toggle='ajax-modal']").on('click',function(e) {
    //A button that should trigger a modal display was clicked

    e.preventDefault();
    var url = $(this).attr('href');         //URL the button was supposed to lead to
    var $modal = $($(this).attr('data-target'));      //modal to open (a simple empty div with an id in the page)
    
    //Getting the form via ajax
    $.get(url, function(data) {
      $modal.html(data);
      $modal.modal('show');
      ajaxForm();
    });
  });
};

//Function to process the modal form
var ajaxForm = function() {
  $('form[data-async]').on('submit', function(e) {
    var $form = $(this);
    var $parent = $($form.parents('.modal')); //The modal: should be closed after processing the form
    var $target = $($form.attr('data-target')); //The row that will be graphically deleted
    var data = $form.serializeArray();
    data.push({name: 'ajax', value: true});

    //After the user submitted the form, ajax call to get the return
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: data,
        dataType: 'json',

        success: function(data) {
          //Graphically removing the the row supposed to be deleted from DB if successfully deleted

          if(data.status === 'success') {
            $target.remove();
            $('#comment-list').trigger('comment-removed');
          }

          //Displaying the received message (confirmation message if everything went fine) to the user
          $('#ajax-message').html(data.messageHTML);

          $parent.modal('hide');
          ajaxModal();
        },
        error: function(xhr) {
          
        }
    });
    e.preventDefault();
  });
};

//Function thats binds an event on the comment list to update the number of comments to validate
var checkCommentDeletion = function() {
  var $commentList = $('#comment-list');
  var $spanCountComments = $('#count-comments-text');

  //Updates the text that indicates the user the number of remaining comments waiting for validation
  $commentList.on('comment-removed', function() {

  var countComments = $('.comment-row', $commentList).length;
  
  if(countComments)
    $spanCountComments.html('<span class="text-info">' + countComments + '</span> avis en attente de validation.');
  else
    $spanCountComments.html("Pas d'avis en attente de validation.");
  });
};