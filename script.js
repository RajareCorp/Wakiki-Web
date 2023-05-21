function addName() {
    const newname = document.getElementById("newname").value;
    var result ="<?php addPlayers("+newname+"); ?>";
    document.write(result);
  }