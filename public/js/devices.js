function confirmDelete(button) {
  if (confirm('Do you really want to delete device?')) {
    button.parentNode.submit();
  } else {
    return false;
  }
}
