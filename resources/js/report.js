console.log("test")
function goBack() {
    history.go(-1);
}


$(document).ready(function() {
    $('.comment-toggle').click(function() {
        $('.comment-input').toggle();
    });
});


// Show the report modal
function showReportModal() {
    var modal = document.getElementById("reportModal");
    modal.style.display = "block";
}

// Hide the report modal
function hideReportModal() {
    var modal = document.getElementById("reportModal");
    modal.style.display = "none";
}

function toggleOtherReason() {
    var otherReasonInput = document.getElementById("otherReason");
    otherReasonInput.style.display = document.getElementById("other").checked ? "block" : "none";
}


// Handle report submission
function submitReport(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    var selectedReason = document.querySelector('input[name="reportReason"]:checked').value;
    if (selectedReason === "other") {
        var otherReasonInput = document.getElementById("otherReason");
        var otherReason = otherReasonInput.value;

        // Make an AJAX request to store the report
        $.ajax({
            url: '/reports',
            type: 'POST',
            data: {
                post_id: '{{ $post->id }}', // Pass the ID of the reported post
                reason: otherReason
            },
            success: function(response) {
                console.log('Report submitted successfully');
                hideReportModal();
            },
            error: function(xhr) {
                console.error('Error submitting report');
            }
        });
    } else {
        // Make an AJAX request to store the report
        $.ajax({
            url: '/reports',
            type: 'POST',
            data: {
                post_id: '{{ $post->id }}', // Pass the ID of the reported post
                reason: selectedReason
            },
            success: function(response) {
                console.log('Report submitted successfully');
                hideReportModal();
            },
            error: function(xhr) {
                console.error('Error submitting report');
            }
        });
    }

    hideReportModal();
}

// Find the form element and attach the submitReport function to its submit event
var reportForm = document.getElementById('reportModal');
reportForm.addEventListener('submit', submitReport);
