function flipSwitch(element, deviceId) {
  let switchStatusObject = document.getElementById(`device_${deviceId}`);
  let switchStatus = switchStatusObject.value;
  let xhr = new XMLHttpRequest();
  xhr.open('GET', `/usages/switchDevice/?deviceId=${deviceId}&switchStatus=${switchStatus}`);
  xhr.onreadystatechange = () => {
    if (xhr.status == 200 && xhr.readyState == 4) {
      let responseText = xhr.responseText;
      let newSwitchStatus = JSON.parse(responseText).switchStatus;
      if (JSON.parse(responseText).status == 'true') {
        element.style.background = newSwitchStatus == '1' ? '#33ee33' : '#ee3333';
        switchStatusObject.value = newSwitchStatus;
        element.innerHTML = newSwitchStatus == '1' ? 'Switch OFF' : 'Switch ON';
      } else {
        alert(JSON.parse(responseText).message);
      }
    }
  }
  xhr.send();
}
