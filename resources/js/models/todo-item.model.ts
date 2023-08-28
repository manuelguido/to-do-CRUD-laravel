export interface TodoItem {
  id: number;
  name: string;
  is_finished: boolean;
  created_at?: Date;
  updated_at?: Date;
}
