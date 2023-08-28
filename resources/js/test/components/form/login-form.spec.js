import { it, expect, test } from "vitest";
import { mount } from '@vue/test-utils';
import LoginForm from '../../../components/form/login-form.vue';

const wrapper = mount(LoginForm);

test("login form is rendered correctly", () => {
  // Form renders correctly
  expect(wrapper.find("form").exists()).toBe(true);

  // Button renders correctly
  expect(wrapper.find("v-btn").exists()).toBe(true);
  
  // Input fields render correctly and there are 2
  const textFields = wrapper.findAll('v-text-field');
  expect(textFields.length).toBe(2);
});

it('does not submit the form when inputs are empty', async () => {
  // Set empty email and password
  await wrapper.setData({ email: '', password: '' });

  // Trigger form submission
  await wrapper.find('form').trigger('submit.prevent');

  // Assert that no changes occurred
  expect(wrapper.find('v-alert').exists()).toBe(false);
  expect(wrapper.vm.error).toBe('');

});
