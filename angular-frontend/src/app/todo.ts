export class Todo {
  id!: number;
  name: string = '';
  status: boolean = false;

  constructor(values: Object = {}) {
    Object.assign(this, values);
  }
}
