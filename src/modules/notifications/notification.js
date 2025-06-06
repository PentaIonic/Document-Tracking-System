function daysBetween(documentDate, today) {
  const timeDifference = Math.abs(documentDate - today);
  return Math.ceil(timeDifference / (1000 * 3600 * 24));
}

function isNotificationDue(documentDate, today) {
  return daysBetween(documentDate, today) >= 2;
}

function loadNotifications() {
  const documentRecords = JSON.parse(localStorage.getItem("documentRecords")) || [];
  const notificationContainer = document.getElementById("notificationList");
  const now = new Date();

  documentRecords.forEach((entry, index) => {
    if (!entry.documentDate) return;

    const docDate = new Date(entry.documentDate);

    if (isNotificationDue(docDate, now) && !entry.dismissed) {
      const notification = document.createElement("div");
      notification.className = "notification";
      notification.setAttribute("data-index", index); // Needed for dismiss

      notification.innerHTML = `
        <div class="notification-info">
          <span class="notification-title">Document is past due date!</span>
          <span class="notification-description">${entry.documentCode}</span>
        </div>
        <div class="notification-close">
          <button type="button" class="removeNotification" data-index="${index}">
            &times;
          </button>
        </div>`;
        
      notificationContainer.appendChild(notification);
    }
  });

  // Use event delegation for dynamic notifications
  notificationContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("removeNotification")) {
      const idx = e.target.getAttribute("data-index");
      dismissNotification(idx);
      e.target.closest(".notification").remove();
    }
  });
}

// Dismiss notification and update localStorage
function dismissNotification(index) {
  const records = JSON.parse(localStorage.getItem("documentRecords")) || [];
  if (records[index]) {
    records[index].dismissed = true;
    localStorage.setItem("documentRecords", JSON.stringify(records));
  }
}