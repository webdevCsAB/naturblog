function copyToClipboard(text) {
  var btnCopy = document.getElementById("ctcbd");
  var tmpInput = document.body.appendChild(document.createElement("input"));
  tmpInput.value = btnCopy.getAttribute('data-clipboard-text'); tmpInput.focus(); tmpInput.select(); 
  document.execCommand('copy');
  tmpInput.parentNode.removeChild(tmpInput);
  btnCopy.innerHTML = btnCopy.getAttribute('data-button-copied');
  setTimeout(() => {
    btnCopy.innerHTML = btnCopy.getAttribute('data-button-def');
  }, 1500)
}
