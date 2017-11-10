  <script>

    jQuery(document).ready(function(){

      // Play Podcast Button
      $('.podcast-item-row .play').on('click', function() {
        $('#player-container').css('display','block');
        $('#player source').attr('src', $(this).attr('data-src'));
        $('#player').trigger('load').trigger('play');
        $('#player-container .now-playing .podcast-item-title').text(
          'Now playing - ' +
          $(this).parents('.podcast-item-row').find('.podcast-item-title > a').text());
        $('.podcast-item-row').removeClass('active');
        $(this).parents('.podcast-item-row').addClass('active');
      });

      // Close Player
      $('.close').click(function(e){
        e.preventDefault();
        $(this).closest('.alert-dismissable').fadeOut(200, function() {
            $('#player').trigger('load').trigger('stop');
        });
        $('.podcast-item-row').each(function () {
          $(this).removeClass('active');
        });
      });

      // Mark as Read Modal
      $('#confirmRead').on('show.bs.modal', function (e) {
        var form = $(e.relatedTarget).attr('data-src');
        var title = $(e.relatedTarget).attr('data-title');

        $(this).find('.modal-body p').html('Are you sure you want to mark <strong><em>'+title+'</em></strong> as read?');
        $(this).find('.modal-title').text('Confirm Mark as Read');
        $(this).find('.modal-footer #confirm').data('form', form);
      });

      // Modal Confirm form trigger
      $('#confirmRead').find('.modal-footer #confirm').on('click', function(){

        // Mark as Read AJAX Form Actions
        var itemId = $(this).data('form');
        var itemRow = $(".mark-as-read[data-src=" + itemId + "]").parents(".podcast-item-row");
        $.ajax({
            type: "POST",
            cache: false,
            url: "/podcast/mark-as-read",
            data: {
                'itemId': itemId,
                '_token': "{{ csrf_token() }}"
            },
            success: function(result) {
              if(result.status === 1)
              {
                  $(itemRow).fadeOut(200);
                  $('#confirmRead').modal('hide');
              }
            }
        });
      });

      // Mark ALL as Read Modal
      $('#confirmAllRead').on('show.bs.modal', function (e) {
        var form = $(e.relatedTarget).attr('data-src');
        var title = $(e.relatedTarget).attr('data-title');

        $(this).find('.modal-body p').html('Are you sure you want to mark all episodes prior to <strong><em>'+title+'</em></strong> in this podcast as read?');
        $(this).find('.modal-title').text('Confirm Mark All as Read');
        $(this).find('.modal-footer #confirm').data('form', form);
      });

      // Modal Confirm Mark ALl as read form trigger
      $('#confirmAllRead').find('.modal-footer #confirm').on('click', function(){
        var itemId = $(this).data('form');
        $.ajax({
            type: "POST",
            cache: false,
            url: "/podcast/mark-all-prev-read",
            data: {
                'itemId': itemId,
                '_token': "{{ csrf_token() }}"
            },
            success: function(result) {
                if(result.status === 1)
                {
                  for(var i = 0; i < result.data.length; i++)
                  {
                    if($(".mark-all-prev-read[data-src=" + result.data[i] + "]"))
                    {
                      $(".mark-all-prev-read[data-src=" + result.data[i] + "]").parents(".podcast-item-row").fadeOut(200);
                    }
                  }
                }
                $('#confirmAllRead').modal('hide');
            }
        });
      });

      // Mark as Favorites AJAX
      $('.mark-as-favorite').on('click', function() {
        var itemId = $(this).attr('data-src');
        $.ajax({
            type: "POST",
            cache: false,
            url: "/podcast/mark-as-favorite",
            data: {
                'itemId': itemId,
                '_token': "{{ csrf_token() }}"
            },
            success: function(result) {
                if(result.status === 1)
                {
                  // change favorite image
                  if(result.currentValue === true)
                  {
                    $(".mark-as-favorite[data-src=" + itemId + "]").find('i').removeClass('fa-heart-o').addClass('fa-heart');
                  } else {
                    $(".mark-as-favorite[data-src=" + itemId + "]").find('i').removeClass('fa-heart').addClass('fa-heart-o');
                  }
                }
            }
        });
      });

      // Enable Bootstrap Tooltips
      $('[data-toggle="tooltip"]').tooltip();

    });

  </script>