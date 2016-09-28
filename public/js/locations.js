function confirmDelete(button) {
  if (confirm('Do you really want to delete location?')) {
    button.parentNode.submit();
  } else {
    return false;
  }
}
