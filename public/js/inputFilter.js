/*
let zip_codeInput = document.getElementById("zip_code");
zip_codeInput.addEventListener("keydown", (key)=>{
    // console.log(key);
    let inputValue = zip_codeInput.value;
    let parsedKey = parseInt(key.key);

    if (inputValue.length < 5) {

        if (typeof(parsedKey) === "number" && isNaN(parsedKey)) {
            inputValue = [...inputValue];
            inputValue.pop();
            inputValue = inputValue.toString();
            zip_codeInput.value = inputValue;
        }
        console.log(inputValue);
        console.log(" plus petit que 5")
    }
   
});
*/