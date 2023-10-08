export interface User {
  id: string;
  nickname: string | null;
  name: string;
  email: string;
  avatar: string;
  user: {
    sub: string;
    name: string;
    given_name: string;
    family_name: string;
    picture: string;
    email: string;
    email_verified: boolean;
    locale: string;
    id: string;
    verified_email: boolean;
    link: string | null;
  };
  attributes: {
    id: string;
    nickname: string | null;
    name: string;
    email: string;
    avatar: string;
    avatar_original: string;
  };
  token: string;
  refreshToken: string | null;
  expiresIn: number;
  approvedScopes: string[];
}
