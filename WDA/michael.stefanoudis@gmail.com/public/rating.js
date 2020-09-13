var list = ['one', 'two', 'three', 'four', 'five'];

list.forEach(function(element) {
    document.getElementById(element).addEventListener("click", function() {
        var status = document.getElementById(element).className;
        // if (status.includes("unchecked")) {
        //     document.getElementById(element).classList.remove("unchecked");
        //     document.getElementById(element).classList.add("checked");
        // } else {
        //     document.getElementById(element).classList.remove("checked");
        //     document.getElementById(element).classList.add("unchecked");
        // }

        if (element === "one") {
            document.getElementById(element).classList.remove("unchecked");
            document.getElementById(element).classList.add("checked");
            document.getElementById("two").classList.add("unchecked");
            document.getElementById("three").classList.add("unchecked");
            document.getElementById("four").classList.add("unchecked");
            document.getElementById("five").classList.add("unchecked");
        } else if (element === "two") {
            document.getElementById("one").classList.remove("unchecked");
            document.getElementById(element).classList.remove("unchecked");
            document.getElementById("one").classList.add("checked");
            document.getElementById(element).classList.add("checked");
            document.getElementById("three").classList.add("unchecked");
            document.getElementById("four").classList.add("unchecked");
            document.getElementById("five").classList.add("unchecked");
        } else if (element === "three") {
            document.getElementById("one").classList.remove("unchecked");
            document.getElementById("two").classList.remove("unchecked");
            document.getElementById(element).classList.remove("unchecked");
            document.getElementById("one").classList.add("checked");
            document.getElementById("two").classList.add("checked");
            document.getElementById(element).classList.add("checked");
            document.getElementById("four").classList.add("unchecked");
            document.getElementById("five").classList.add("unchecked");
        } else if (element === "four") {
            document.getElementById("one").classList.remove("unchecked");
            document.getElementById("two").classList.remove("unchecked");
            document.getElementById("three").classList.remove("unchecked");
            document.getElementById(element).classList.remove("unchecked");
            document.getElementById("one").classList.add("checked");
            document.getElementById("two").classList.add("checked");
            document.getElementById("three").classList.add("checked");
            document.getElementById(element).classList.add("checked");
            document.getElementById("five").classList.add("unchecked");
        } else {
            document.getElementById("one").classList.remove("unchecked");
            document.getElementById("two").classList.remove("unchecked");
            document.getElementById("three").classList.remove("unchecked");
            document.getElementById("four").classList.remove("unchecked");
            document.getElementById(element).classList.remove("unchecked");
            document.getElementById("one").classList.add("checked");
            document.getElementById("two").classList.add("checked");
            document.getElementById("three").classList.add("checked");
            document.getElementById("four").classList.add("checked");
            document.getElementById(element).classList.add("checked");
        }
    });
});