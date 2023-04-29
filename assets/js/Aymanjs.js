function addCount(id) {
    var count = document.getElementById(id);
    count.innerHTML = parseInt(count.innerHTML) + 1;
  }
  
  function resetCount(id) {
    var count = document.getElementById(id);
    count.innerHTML = 0;
  }