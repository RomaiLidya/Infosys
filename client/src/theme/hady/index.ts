import { createMuiTheme } from '@material-ui/core/styles';
import { BLUE_PRIMARY, BLUE_SECONDARY, BLACK, BLACK_2, WHITE, GREY, BACKGROUND, GRAY_3, RED } from 'constants/colors';

declare module '@material-ui/core/styles/createMuiTheme' {
  interface Theme {
    border: {
      primary: string;
    };
  }
  // allow configuration using `createMuiTheme`
  interface ThemeOptions {
    border?: {
      primary?: string;
    };
  }
}

const theme = createMuiTheme({
  border: {
    primary: '#F2F2F2'
  },
  palette: {
    primary: {
      main: BLUE_PRIMARY,
      dark: BLUE_SECONDARY,
      contrastText: WHITE
    },
    secondary: {
      main: GREY,
      contrastText: WHITE
    },
    background: {
      default: BACKGROUND
    },
    error: {
      main: RED
    }
  },
  typography: {
    fontFamily: ['"Rubik"'].join(','),
    h1: {
      fontSize: '28px',
      fontWeight: 500,
      fontStyle: 'normal',
      color: GRAY_3
    },
    h5: {
      fontSize: '20px',
      fontWeight: 500,
      fontStyle: 'normal',
      lineHeight: '32px',
      color: BLACK
    },
    h6: {
      fontSize: '16px',
      fontWeight: 500,
      fontStyle: 'normal',
      color: '#333333'
    },
    subtitle1: {
      fontSize: '12px',
      fontWeight: 400,
      fontStyle: 'normal',
      color: GRAY_3,
      letterSpacing: '0.4px',
      lineHeight: ''
    },
    subtitle2: {
      fontSize: '14px',
      fontWeight: 'normal',
      fontStyle: 'normal',
      color: GRAY_3,
      letterSpacing: '0.4px',
      lineHeight: '24px'
    },
    body2: {
      fontSize: '15px',
      fontWeight: 500,
      fontStyle: 'normal',
      color: GRAY_3,
      lineHeight: '24px'
    }
  },
  props: {
    MuiButton: {
      variant: 'contained',
      color: 'primary'
    },
    MuiTableCell: {
      color: '#2E384D',
      align: 'left'
    },
    MuiPaper: {
      elevation: 0
    },
    MuiTextField: {
      margin: 'dense',
      size: 'small',
      variant: 'outlined'
    }
  },
  overrides: {
    MuiCssBaseline: {
      '@global': {
        /* custom scrollbar */
        '::-webkit-scrollbar': {
          width: '20px'
        },

        '::-webkit-scrollbar-track': {
          backgroundColor: 'transparent'
        },

        '::-webkit-scrollbar-thumb': {
          backgroundColor: '#a8bbbf',
          borderRadius: '20px',
          border: '6px solid transparent',
          backgroundClip: 'content-box'
        },

        '::-webkit-scrollbar-thumb:hover': {
          backgroundColor: '#a8bbbf'
        }
      }
    },
    MuiOutlinedInput: {
      root: {
        background: '#F7F9FC'
      }
    },
    MuiIconButton: {
      root: {
        color: '#231F20'
      }
    },
    MuiTableCell: {
      root: {
        fontWeight: 'normal',
        fontSize: '15px',
        lineHeight: '22px',
        color: BLACK_2
      }
    }
  }
});

export default theme;
