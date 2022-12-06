import { Todo } from './todo';

describe('Todo', () => {
  it('should create an instance', () => {
    expect(new Todo()).toBeTruthy();
  });

  it('should accept values in the constructor', () => {
    let todo = new Todo({
      name: 'hello',
      status: true
    });
    expect(todo.name).toEqual('hello');
    expect(todo.status).toEqual(true);
  });
});
