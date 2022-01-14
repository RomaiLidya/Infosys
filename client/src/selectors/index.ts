export const isUserAuthenticated = (currentUser?: CurrentUser): boolean => {
  return currentUser ? true : false;
};

export const getCurrentUserDisplayName = (currentUser?: CurrentUser): string => {
  return currentUser ? currentUser.displayName : '';
};

export const getCurrentUserId = (currentUser?: CurrentUser): number => {
  return currentUser ? currentUser.id : 0;
};

export const getCurrentUserAvatarName = (currentUser?: CurrentUser): string => {
  return currentUser ? currentUser.displayName[0].toUpperCase() : '';
};

export const hasAccess = (currentUser?: CurrentUser, name?: string): boolean => {
  let temp = false;

  if (currentUser && name) {
    const permission = currentUser.permission;
    
    if (!permission['ADMINISTRATION'] === false || permission[name]) {
      temp = true
    }
  }

  return temp;
};
