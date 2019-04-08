import React from 'react';
import { Router, Link as RouterLink } from '@reach/router';
import { baseUrl } from '../../core/variables';

export default function Link({ to, children, ...rest }) {
  return (
    <RouterLink to={`${baseUrl}${to}`} {...rest}>
      {children}
    </RouterLink>
  );
}
