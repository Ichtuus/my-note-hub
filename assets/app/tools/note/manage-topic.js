export default () => {
    notesSubscriber()
}

function notesSubscriber() {
    const hub = 'http://localhost:3000/.well-known/mercure?topic='
    const topic = 'my-note-hub.localhost/note'
    const eventSource = new EventSource(hub + encodeURIComponent(topic) )
    eventSource.onmessage = event => {
        // Will be called every time an update is published by the server
        console.log('event', event)
    }


}
