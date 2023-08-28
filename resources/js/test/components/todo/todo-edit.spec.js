import { it, expect, test } from 'vitest';
import { mount } from '@vue/test-utils';
import TodoEdit from '../../../components/todo/todo-edit.vue';

test('TodoEditComponent', () => {
  // Mount Wrapper 
  const wrapper = mount(TodoEdit);

  it('renders the component', () => {

    // Check component is rendered
    expect(wrapper.exists()).toBe(true);
  });

  it('contains necessary Vuetify elements', () => {

    // Check Vuetify elements are present
    const vListItem = wrapper.findComponent({ name: 'v-list-item' });
    const vListAction = vListItem.findComponent({ name: 'v-list-item-action' });
    const vBtn = vListAction.findComponent({ name: 'v-btn' });

    expect(vListItem.exists()).toBe(true);
    expect(vListAction.exists()).toBe(true);
    expect(vBtn.exists()).toBe(true);
  });
});
