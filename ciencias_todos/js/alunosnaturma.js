function checkLastRow(input) {
    const table = document.getElementById("alunoTable");
    const rows = table.getElementsByTagName("tr");
    const lastRowInputs = rows[rows.length - 1].getElementsByTagName("input");

    const allFilled = Array.from(lastRowInputs).every(input => input.value.trim() !== "");

    if (allFilled) {
      const newRow = document.createElement("tr");
      for (let i = 0; i < 1; i++) {
        const cell = document.createElement("td");
        const newInput = document.createElement("input");
        newInput.type = "text";
        newInput.placeholder = ["Nome"][i];
        newInput.oninput = function () {
          checkLastRow(newInput);
        };
        cell.appendChild(newInput);
        newRow.appendChild(cell);
      }
      table.appendChild(newRow);
    }
  }
