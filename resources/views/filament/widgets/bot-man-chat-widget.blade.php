<!-- resources/views/filament/widgets/botman-chat-widget.blade.php -->
<div>
    <!-- BotMan Chat Widget Configuration -->
    <script>
        var botmanWidget = {
            frameEndpoint: '{{ route("botman.chatframe") }}',
            title: "Ask about the Database", // Optional: Customize the title of your chat widget
            introMessage: "What question do you have about the database?", // Optional: Customize the welcome message
            placeholderText: "Send a message...", // Optional: Customize the placeholder text in the message input box
            //aboutText: "Powered by BotMan" // Optional: Customize the 'about' text
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</div>
