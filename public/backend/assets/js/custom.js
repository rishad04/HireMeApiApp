// notification
document.addEventListener('DOMContentLoaded', () => {
    const notificationIcon = document.getElementById('notificationIcon');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationCounter = document.getElementById('notificationCounter');
    const notificationList = document.getElementById('notificationList');

    let currentNotificationCount = parseInt(notificationCounter.textContent);

    // Function to update the counter visibility and text
    const updateCounter = () => {
        if (currentNotificationCount > 0) {
            notificationCounter.textContent = currentNotificationCount;
            notificationCounter.classList.remove('hidden');
        } else {
            notificationCounter.classList.add('hidden');
        }
    };

    // Toggle dropdown visibility
    notificationIcon.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent document click from immediately closing
        notificationDropdown.classList.toggle('active');

        // On expand, the counter should be removed (set to 0 and hidden)
        if (notificationDropdown.classList.contains('active')) {
            currentNotificationCount = 0;
            updateCounter();
        }
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (event) => {
        if (!notificationDropdown.contains(event.target) && !notificationIcon.contains(event.target)) {
            notificationDropdown.classList.remove('active');
            // If closed by clicking outside, the counter state remains as is.
            // If you want to reset counter to a new "unread" count when closed,
            // you'd need a separate mechanism for marking notifications as read/unread.
        }
    });

    // Handle removing individual notifications
    notificationList.addEventListener('click', (event) => {
        const removeButton = event.target.closest('.remove-notification');
        if (removeButton) {
            const notificationItem = removeButton.closest('.notification-item');
            if (notificationItem) {
                // Optional: You could update the counter here if dismissed individually
                // currentNotificationCount--; // This depends on your definition of "unread"
                // updateCounter();

                notificationItem.style.opacity = '0';
                notificationItem.style.height = '0';
                notificationItem.style.overflow = 'hidden';
                notificationItem.style.paddingTop = '0';
                notificationItem.style.paddingBottom = '0';
                notificationItem.style.borderBottom = 'none';
                notificationItem.style.marginTop = '0';
                notificationItem.style.marginBottom = '0';
                notificationItem.style.transition = 'opacity 0.3s ease, height 0.3s ease, padding 0.3s ease, margin 0.3s ease';

                // Remove from DOM after transition
                notificationItem.addEventListener('transitionend', () => {
                    notificationItem.remove();
                    // After removing, check if any notifications are left
                    // If no items are left, update the counter to 0 (if not already 0)
                    if (notificationList.children.length === 0) {
                        currentNotificationCount = 0;
                        updateCounter();
                        // Optional: Display a "No new notifications" message
                        if (!document.getElementById('noNotificationsMessage')) {
                            const noNotificationsDiv = document.createElement('div');
                            noNotificationsDiv.id = 'noNotificationsMessage';
                            noNotificationsDiv.style.textAlign = 'center';
                            noNotificationsDiv.style.padding = '20px';
                            noNotificationsDiv.style.color = '#777';
                            noNotificationsDiv.textContent = 'No new notifications';
                            notificationList.appendChild(noNotificationsDiv);
                        }
                    }
                }, { once: true });
            }
        }
    });

    // Initial counter update on load
    updateCounter();
});

// notification end