function confirmDelete(button) {
  if (confirm('Do you really want to delete distributor?')) {
    button.parentNode.submit();
  } else {
    return false;
  }
}
