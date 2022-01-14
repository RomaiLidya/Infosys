import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import { makeStyles } from '@material-ui/styles';
import { IconButton, Theme, Modal, Grid, Typography, Tabs, Tab, InputAdornment, TextField, Button } from '@material-ui/core';
import { TabPanel, a11yProps } from 'components';
import { isValidEmail } from 'utils';
import { USER_BASE_URL } from 'constants/url';
import { Visibility, VisibilityOff } from '@material-ui/icons';
import CloseIcon from '@material-ui/icons/Close';
import EditProfileForm from './components/EditProfileForm';

interface Props {
  open: boolean;
  user?: CurrentUser;
  userId: number;
  handleCancel(): void;
  setOpenSnackbar: React.Dispatch<React.SetStateAction<boolean>>;
  setSnackbarVarient: React.Dispatch<React.SetStateAction<'success' | 'error'>>;
}

const useStyles = makeStyles((theme: Theme) => ({
  paper: {
    position: 'absolute',
    backgroundColor: theme.palette.background.paper,
    boxShadow: theme.shadows[5],
    padding: theme.spacing(2),
    outline: 'none',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    borderRadius: 4
  },
  closeButton: {
    position: 'absolute',
    right: theme.spacing(1),
    top: theme.spacing(1),
    color: theme.palette.grey[500]
  },
  full: {
    width: '100%'
  }
}));

const UpdateProfileModal: React.FC<Props> = props => {
  const classes = useStyles();

  const { user, userId, open, handleCancel, setOpenSnackbar, setSnackbarVarient } = props;
  const [isLoading, setLoading] = useState<boolean>(false);

  const [email, setEmail] = useState<string>('');
  const [firstName, setFirstName] = useState<string>('');
  const [lastName, setLastName] = useState<string>('');
  const [password, setPassword] = useState<string>('');
  const [confirmPassword, setConfirmPassword] = useState<string>('');
  const [contactNumber, setContactNumber] = useState<string>('');
  const [selectedRoleId, setSelectedRoleId] = useState<number>(0);
  const [pin, setPin] = useState<string>('');

  const [emailError, setEmailError] = useState<string>('');
  const [firstNameError, setFirstNameError] = useState<string>('');
  const [passwordError, setPasswordError] = useState<string>('');
  const [contactNumberError, setContactNumberError] = useState<string>('');
  const [roleIdError, setRoleIdError] = useState<string>('');
  const [pinError, setPinError] = useState<string>('');
  const [isShowPassword, setShowPassword] = useState<boolean>(false);

  const [value, setValue] = useState<number>(0);
  const handleChange = ({}, newValue: number) => {
    setValue(newValue);
  };

  const resetFormValues = useCallback(() => {
    if (!user) {
      return;
    }
    const { email, firstName, lastName, contactNumber } = user;

    setEmail(email);
    setFirstName(firstName);
    setLastName(lastName);
    setContactNumber(contactNumber);
    setPin(user.pin || '');
  }, [user]);

  useEffect(() => {
    resetFormValues();
    clearFormErrors();
  }, [resetFormValues]);

  const clearFormErrors = () => {
    setEmailError('');
    setFirstNameError('');
    setPassword('');
    setConfirmPassword('');
    setPasswordError('');
    setContactNumberError('');
    setRoleIdError('');
    setPinError('');
  };

  // This is to ensure that the form vale and erors are reset/cleared when user canceled the editing
  const handleOnClose = () => {
    resetFormValues();
    clearFormErrors();
    handleCancel();
  };

  const validateForm = () => {
    let ret = true;
    clearFormErrors();

    if (!email || !email.trim()) {
      setEmailError('Please enter email');
      ret = false;
    } else if (!isValidEmail(email)) {
      setEmailError('Please enter an valid email');
      ret = false;
    }

    if (!firstName || !firstName.trim()) {
      setFirstNameError('Please enter display firstName');
      ret = false;
    }

    if (!contactNumber || !contactNumber.trim()) {
      setContactNumberError('Please enter contact number');
      ret = false;
    }

    if (pin.length < 6 || pin.length > 6) {
      setPinError('PIN harus 6 digit angka');
      ret = false;
    }

    if (value > 0) {
      if (password !== confirmPassword) {
        setPasswordError('Password and confirm password is different');
        ret = false;
      }
    }

    return ret;
  };

  const handleChangePassword = async () => {};

  const handleOnSubmit: React.FormEventHandler = async event => {
    event.preventDefault();

    if (!validateForm()) {
      return;
    }

    setLoading(true);

    try {
      await axios.post(USER_BASE_URL, {
        id: userId,
        firstName,
        lastName,
        displayName: firstName,
        email,
        newPassword: password ? password : undefined,
        contactNumber,
        pin
      });

      setOpenSnackbar(true);
      setSnackbarVarient('success');
      handleCancel();
    } catch (err) {
      console.log(err);
      const { errorCode } = err.data;

      if (errorCode === 5) {
        setOpenSnackbar(true);
        setSnackbarVarient('error');
        setEmailError('User is duplicated.');
      }

      if (errorCode === 4) {
        setOpenSnackbar(true);
        setSnackbarVarient('error');
        setPasswordError('Password must contain letters (A-Z and a-z), numbers (1-9) and be 12 or more characters');
      }
    }

    setLoading(false);
  };

  return (
    <Modal aria-labelledby='modal-title' open={open} disableBackdropClick={true}>
      <Grid container item lg={5} xl={5} md={5} spacing={1} direction='row' className={classes.paper}>
        <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
          <Typography variant='h4' id='modal-title' color='primary' align='center'>
            Profil
          </Typography>
          <IconButton size='small' className={classes.closeButton} onClick={handleOnClose}>
            <CloseIcon />
          </IconButton>
        </Grid>

        <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
          <Tabs value={value} indicatorColor='primary' onChange={handleChange} aria-label='disabled tabs example'>
            <Tab label='Personal Informasi' {...a11yProps(0)} />
            <Tab label='Ubah Kata Sandi' {...a11yProps(1)} />
          </Tabs>
        </Grid>

        <TabPanel value={value} index={0} className={classes.full}>
          <EditProfileForm
            email={email}
            setEmail={setEmail}
            emailError={emailError}
            firstName={firstName}
            setFirstName={setFirstName}
            lastName={lastName}
            setLastName={setLastName}
            firstNameError={firstNameError}
            contactNumber={contactNumber}
            setContactNumber={setContactNumber}
            contactNumberError={contactNumberError}
            selectedRoleId={selectedRoleId}
            setSelectedRoleId={setSelectedRoleId}
            roleIdError={roleIdError}
            pin={pin}
            setPin={setPin}
            pinError={pinError}
            isSubmitting={isLoading}
            onSubmit={handleOnSubmit}
            onCancel={handleOnClose}
          />
        </TabPanel>

        <TabPanel value={value} index={1} className={classes.full}>
          <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
            <TextField
              variant='outlined'
              margin='normal'
              required
              fullWidth
              name='password'
              label='Kata Sandi'
              type={isShowPassword ? 'text' : 'password'}
              id='password'
              autoComplete='current-password'
              error={passwordError !== ''}
              helperText={passwordError}
              onChange={event => setPassword(event.target.value)}
              value={password}
              InputProps={{
                endAdornment: (
                  <InputAdornment position='end'>
                    <IconButton edge='end' aria-label='toggle password visibility' onClick={event => setShowPassword(!isShowPassword)}>
                      {isShowPassword ? <VisibilityOff /> : <Visibility />}
                    </IconButton>
                  </InputAdornment>
                )
              }}
            />
          </Grid>
          <Grid item xs={12} sm={12} md={12} lg={12} xl={12}>
            <TextField
              variant='outlined'
              margin='normal'
              required
              fullWidth
              name='confirmPassword'
              label='Konfirmasi Kata Sandi'
              type={isShowPassword ? 'text' : 'password'}
              id='confirmPassword'
              autoComplete='current-password'
              error={passwordError !== ''}
              helperText={passwordError}
              onChange={event => setConfirmPassword(event.target.value)}
              value={confirmPassword}
              InputProps={{
                endAdornment: (
                  <InputAdornment position='end'>
                    <IconButton edge='end' aria-label='toggle password visibility' onClick={event => setShowPassword(!isShowPassword)}>
                      {isShowPassword ? <VisibilityOff /> : <Visibility />}
                    </IconButton>
                  </InputAdornment>
                )
              }}
            />
          </Grid>

          <Grid container spacing={1} item justify='center' xs={12} sm={12} md={12} lg={12} xl={12}>
            <Grid item>
              <Button color='secondary'>Batal</Button>
            </Grid>
            <Grid item>
              <Button>Ubah Kata Sandi</Button>
            </Grid>
          </Grid>
        </TabPanel>
      </Grid>
    </Modal>
  );
};

export default UpdateProfileModal;
