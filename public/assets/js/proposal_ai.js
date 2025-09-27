$(document).ready(function() {
    $('.chat-send-btn').on('click', function() {
        var prompt = $('.chat-input').text().trim();
        if (!prompt) {
            alert('Please enter a prompt.');
            return;
        }

        // Show loading state
        $('.loading-overlay').css('display', 'flex');
        $('.content').addClass('is-loading');

        // The proposal data is available in the global window.proposalData object
        var proposalData = window.proposalData;

        var requestData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            prompt: prompt,
            proposal_data: proposalData
        };

        $.ajax({
            url: '/proposal/ask-ai',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(requestData),
            success: function(response) {
                // On success, simply reload the page to show the updated content
                location.reload();
            },
            error: function(xhr) {
                // On error, hide loading state and show a custom modal
                $('.loading-overlay').hide();
                $('.content').removeClass('is-loading');
                
                var errorMsg = 'An unknown error occurred.';
                var errorDetails = '';

                if (xhr.responseJSON) {
                    errorMsg = xhr.responseJSON.error || errorMsg;
                    if (xhr.responseJSON.details) {
                        // Attempt to parse details if it's a stringified JSON
                        try {
                            var details = JSON.parse(xhr.responseJSON.details);
                            errorDetails = JSON.stringify(details, null, 2);
                        } catch (e) {
                            errorDetails = xhr.responseJSON.details;
                        }
                    }
                }

                $('#errorModalMessage').text(errorMsg);
                if (errorDetails) {
                    $('#errorModalDetails').text(errorDetails).show();
                } else {
                    $('#errorModalDetails').hide();
                }
                
                $('#errorModal').fadeIn();
                console.error('AI Error:', xhr.responseJSON);
            }
        });
    });

    // Close modal logic
    $('.modal-close').on('click', function() {
        $('.modal-overlay').fadeOut();
    });

    $(document).on('click', function(e) {
        if ($(e.target).is('.modal-overlay')) {
            $('.modal-overlay').fadeOut();
        }
    });
});