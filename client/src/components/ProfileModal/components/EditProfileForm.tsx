import React from 'react';
import { Grid, TextField, Button, Theme, withStyles } from '@material-ui/core';
import { orange } from '@material-ui/core/colors';
import { makeStyles } from '@material-ui/styles';
import { WHITE } from 'constants/colors';

interface Props {
  email: string;
  firstName: string;
  lastName: string;
  contactNumber: string;
  selectedRoleId: number;
  pin: string;
  emailError: string;
  firstNameError: string;
  contactNumberError: string;
  roleIdError: string;
  pinError: string;
  isSubmitting: boolean;

  setEmail: React.Dispatch<React.SetStateAction<string>>;
  setFirstName: React.Dispatch<React.SetStateAction<string>>;
  setLastName: React.Dispatch<React.SetStateAction<string>>;
  setContactNumber: React.Dispatch<React.SetStateAction<string>>;
  setSelectedRoleId: React.Dispatch<React.SetStateAction<number>>;
  setPin: React.Dispatch<React.SetStateAction<string>>;
  onSubmit: React.FormEventHandler;
  onCancel: React.MouseEventHandler;
}

const UpdateButton = withStyles(theme => ({
  root: {
    color: theme.palette.getContrastText(orange[500]),
    backgroundColor: '#EF965A',
    '&:hover': {
      backgroundColor: orange[700]
    }
  }
}))(Button);

const useStyles = makeStyles((theme: Theme) => ({
  controlDiv: {
    '& > :nth-child(n+2)': {
      marginLeft: theme.spacing(2)
    }
  },
  updateButton: {
    color: WHITE
  }
}));

const EditProfileForm: React.FC<Props> = props => {
  const classes = useStyles();

  const { email, setEmail, emailError } = props;
  const { firstName, lastName, setFirstName, firstNameError, setLastName } = props;
  const { contactNumber, setContactNumber, contactNumberError } = props;
  const { pin, setPin, pinError } = props;
  const { isSubmitting, onSubmit, onCancel } = props;

  return (
    <form noValidate onSubmit={onSubmit}>
      <Grid container direction='row' spacing={1}>
        <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
          <TextField
            variant='outlined'
            margin='normal'
            required
            fullWidth
            id='email'
            label='Email'
            error={emailError !== ''}
            helperText={emailError}
            value={email}
            onChange={event => setEmail(event.target.value)}
            autoComplete='off'
          />
        </Grid>
        <Grid item xs={12} sm={12} md={6} lg={6} xl={6}>
          <TextField
            variant='outlined'
            margin='normal'
            required
            fullWidth
            id='name'
            label='Nama Depan'
            error={firstNameError !== ''}
            helperText={firstNameError}
            value={firstName}
            onChange={event => setFirstName(event.target.value)}
            autoComplete='off'
          />
        </Grid>

        <Grid item xs={12} sm={12} md={6} lg={6} xl={6}>
          <TextField
            variant='outlined'
            margin='normal'
            fullWidth
            id='name'
            label='Nama Belakang'
            value={lastName}
            onChange={event => setLastName(event.target.value)}
            autoComplete='off'
          />
        </Grid>

        <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
          <TextField
            variant='outlined'
            margin='normal'
            required
            fullWidth
            id='pin'
            type='password'
            label='PIN'
            value={pin}
            onChange={event => setPin(event.target.value)}
            autoComplete='off'
            error={pinError !== ''}
            helperText={pinError}
          />
        </Grid>
        <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
          <TextField
            variant='outlined'
            margin='normal'
            required
            fullWidth
            id='contactNumber'
            label='Contact Number'
            error={contactNumberError !== ''}
            helperText={contactNumberError}
            value={contactNumber}
            onChange={event => setContactNumber(event.target.value)}
            autoComplete='off'
          />
        </Grid>

        <Grid container item justify='center' xs={12} sm={12} md={12} lg={12} xl={12} className={classes.controlDiv}>
          <Button variant='contained' onClick={onCancel} disabled={isSubmitting}>
            Batal
          </Button>
          <UpdateButton type='submit' variant='contained' color='primary' className={classes.updateButton} disabled={isSubmitting}>
            Simpan
          </UpdateButton>
        </Grid>
      </Grid>
    </form>
  );
};

export default EditProfileForm;
