@if(session('success'))
<div class="alert alert-success session-message" role="alert">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger session-message" role="alert">
    {{ session('error') }}
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning session-message" role="alert">
    {{ session('warning') }}
</div>
@endif

@if(session('info'))
<div class="alert alert-info session-message" role="alert">
    {{ session('info') }}
</div>
@endif

@if(session('status'))
<div class="alert alert-primary session-message" role="alert">
    {{ session('status') }}
</div>
@endif


<style>
    /* Custom session message container */
    .session-message {
        position: fixed;
        /* Position fixed to stay on screen even when scrolling */
        top: 20px;
        /* Distance from the top of the screen */
        right: 20px;
        /* Distance from the right of the screen */
        width: 300px;
        /* Fixed width for larger screens */
        max-width: 90%;
        /* Make sure the message doesn't exceed 90% of the screen width */
        padding: 15px;
        /* Padding inside the alert */
        border-radius: 8px;
        /* Rounded corners */
        z-index: 1050;
        /* Ensure it's above other content */
        opacity: 1;
        /* Fully visible */
        transition: opacity 1s ease-out, transform 0.5s ease;
        /* Smooth transition for fading and sliding */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Slight shadow for better visibility */
    }

    /* Success - Green */
    .alert-success {
        background-color: #28a745 !important;
        /* Pure green */
        color: white !important;
        /* White text */
    }

    /* Error - Red */
    .alert-danger {
        background-color: #dc3545 !important;
        /* Pure red */
        color: white !important;
        /* White text */
    }

    /* Warning - Yellow */
    .alert-warning {
        background-color: #ffc107 !important;
        /* Pure yellow */
        color: black !important;
        /* Dark text for contrast */
    }

    /* Info - Blue */
    .alert-info {
        background-color: #17a2b8 !important;
        /* Pure blue */
        color: white !important;
        /* White text */
    }

    /* Primary - Blue variant */
    .alert-primary {
        background-color: #007bff !important;
        /* Pure blue */
        color: white !important;
        /* White text */
    }

    /* When message fades out, it becomes transparent and slightly moves up */
    .session-message.fade-out {
        opacity: 0;
        transform: translateY(-20px);
        /* Move the message up as it fades */
    }

    /* Media Queries for responsiveness */
    @media (max-width: 768px) {

        /* On small screens (like tablets), set the max-width to 80% */
        .session-message {
            width: 80%;
        }
    }

    @media (max-width: 480px) {

        /* On very small screens (like mobile), set the max-width to 95% */
        .session-message {
            width: 95%;
        }

        /* Adjust the position to be more centered */
        .session-message {
            right: 10px;
            /* More padding for small screens */
        }
    }
</style>

<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function () {
        // Select all elements with the class 'session-message'
        const sessionMessages = document.querySelectorAll(".session-message");

        // Iterate over each session message
        sessionMessages.forEach((message) => {
            // Set a timeout to add the fade-out class after 3 seconds
            setTimeout(() => {
                message.classList.add("fade-out");
            }, 3000);

            // Set another timeout to remove the element from the DOM after the fade-out transition
            setTimeout(() => {
                message.remove();
            }, 4000); // 1 second after fade-out for a smooth transition
        });
    });
</script>
