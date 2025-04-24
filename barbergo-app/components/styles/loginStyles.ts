import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  Body: {
    flexGrow: 1,
    backgroundColor: '#1f1f1f',
    justifyContent: 'space-between',
  },
  encabezado: {
    backgroundColor: 'gold',
    padding: 10,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  logo: {
    width: 100,
    height: 60,
    resizeMode: 'contain',
  },
  navText: {
    color: 'black',
    fontWeight: 'bold',
    fontSize: 16,
  },
  loginContainer: {
    maxWidth: 400,
    alignSelf: 'center',
    marginTop: 100,
    padding: 20,
    backgroundColor: '#1e1e1e',
    borderRadius: 10,
    shadowColor: '#FFD700',
    shadowOpacity: 0.3,
    shadowOffset: { width: 0, height: 0 },
    shadowRadius: 10,
  },
  title: {
    fontSize: 24,
    color: '#fff',
    marginBottom: 20,
    textAlign: 'center',
  },
  input: {
    backgroundColor: '#fff',
    padding: 10,
    borderRadius: 5,
    marginVertical: 10,
  },
  button: {
    backgroundColor: 'gold',
    padding: 10,
    borderRadius: 5,
    alignItems: 'center',
    marginTop: 10,
  },
  buttonText: {
    color: 'black',
    fontWeight: 'bold',
    fontSize: 16,
  },
  error: {
    color: 'red',
    marginTop: 10,
    textAlign: 'center',
  },
  links: {
    marginTop: 20,
    alignItems: 'center',
  },
  link: {
    color: 'gold',
    textDecorationLine: 'underline',
  },
  footer: {
    backgroundColor: 'gold',
    alignItems: 'center',
    padding: 10,
    marginTop: 30,
  },
});
