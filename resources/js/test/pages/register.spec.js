import { it, expect, test } from "vitest";
import { mount } from '@vue/test-utils';
import Register from '../../pages/register.vue';

test('RegisterPage', () => {
  it('renders the register form', async () => {
    // Mount the LoginContainer component
    const wrapper = mount(Register);

    // Check if register form component is rendered
    wrapper.findComponent({ name: 'register-form' }).expect(loginForm.exists()).toBe(true);
  });
});
