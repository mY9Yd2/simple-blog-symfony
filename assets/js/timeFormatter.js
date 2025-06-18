export function formatTimeElements() {
    document.querySelectorAll("time[datetime]").forEach(timeElement => {
        const date = new Date(timeElement.getAttribute('datetime'));
        timeElement.textContent = date.toLocaleString(undefined, {
            dateStyle: 'medium',
            timeStyle: 'short'
        });
    });
}
