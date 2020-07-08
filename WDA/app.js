console.log("Hello world!")


// Primitive Data Types
// String
var name = "Michael";
// Number
// var age = 25;
// Boolean
var isActive = true;
// Null
var ferrari = null;
// Undefined
var notDefined;
// Symbols (ES6)
var symbol = Symbol("Symbol");

console.log(name);
console.log(typeof name);

var lastname = "Stefanoudis444";
console.log(lastname);

const firstName = "John";
const age = 38;
const str1 = "Hello, my name is " + firstName + " and I am " + age + "!!!";
const str2 = `Hello, my name is ${firstName} and I am ${age} !!!`;

console.log(str1);
console.log(str2);

const color = "red";

function sayHello(name = "John", age = 38) {
    return `Hello, my name is ${name} and I am ${age}!`;
}

console.log(sayHello("George", 28));

const languages=["Javascript", "PHP", "Rust"];
const arr=languages.map(
    (language) => { return language.length;}
);

console.log(arr);