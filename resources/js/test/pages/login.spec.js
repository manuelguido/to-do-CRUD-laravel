import { it, expect, test } from "vitest";
import { mount } from '@vue/test-utils';
import Login from '../../pages/login.vue';

test('LoginPage', () => {
  it('renders the login form', async () => {
    // Mount the LoginContainer component
    const wrapper = mount(Login);

    // Check if login form component is rendered
    wrapper.findComponent({ name: 'login-form' }).expect(loginForm.exists()).toBe(true);
  });
});
