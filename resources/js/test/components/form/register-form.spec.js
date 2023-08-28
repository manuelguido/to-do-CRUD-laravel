import { it, expect, test } from "vitest";
import { mount } from '@vue/test-utils';
import RegisterForm from '../../../components/form/register-form.vue';

const wrapper = mount(RegisterForm);

test("register form is rendered correctly", () => {
  // Form renders correctly
  expect(wrapper.find("form").exists()).toBe(true);

  // Button renders correctly
  expect(wrapper.find("v-btn").exists()).toBe(true);

  // Input fields render correctly and there are 3
  const textFields = wrapper.findAll('v-text-field');
  expect(textFields.length).toBe(3);
});

it('does not submit the form when inputs are empty', async () => {
  // Set empty name, email and password
  await wrapper.setData({ name: '', email: '', password: '' });

  // Trigger form submission
  await wrapper.find('form').trigger('submit.prevent');

  // Assert that no changes occurred
  expect(wrapper.find('v-alert').exists()).toBe(false);
  expect(wrapper.vm.error).toBe('');

});
