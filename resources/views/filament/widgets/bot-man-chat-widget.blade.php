<!-- resources/views/filament/widgets/botman-chat-widget.blade.php -->
<div>
    <!-- BotMan Chat Widget Configuration -->
    <script>
        var botmanWidget = {
            frameEndpoint: '{{ route("botman.chatframe") }}',
            title: "Chat with Us", // Optional: Customize the title of your chat widget
            introMessage: "Hello! How can I help you?", // Optional: Customize the welcome message
            placeholderText: "Send a message...", // Optional: Customize the placeholder text in the message input box
            aboutText: "Powered by BotMan" // Optional: Customize the 'about' text
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</div>
