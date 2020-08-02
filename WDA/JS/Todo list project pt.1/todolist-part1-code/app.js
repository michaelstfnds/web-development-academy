class Todo {
  constructor(title, done) {
    this.title = title;
    this.done = done;
  }
}

class TodoList {
  constructor() {
    this.list = [];
  }

  addTodo(todo) {
    this.list.push(todo);
  }
}

const todo1 = new Todo("Learn JavaScript", false);
const list = new TodoList();
list.addTodo(todo1);

console.log(todo1);
console.log(list);
