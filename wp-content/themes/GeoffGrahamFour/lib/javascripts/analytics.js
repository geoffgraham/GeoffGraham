// Remove visits with page interactions from Bounce Rate
// Source: http://davidwalsh.name/analytics-bounce-rate

// Look for clicks and window scroll
function removeEvents() {
	document.body.removeEventListener('click', sendInteractionEvent);
	window.removeEventListener('scroll', sendInteractionEvent);
}

// Record those actions as events
function sendInteractionEvent() {
	ga('send', 'event', 'Page Interaction');
	removeEvents();
}

document.body.addEventListener('click', sendInteractionEvent);
window.addEventListener('scroll', sendInteractionEvent);