import { StyleSheet } from 'react-native';

const styles = StyleSheet.create({
  menuIconRight: {
    fontSize: 28,
    position: 'absolute',
    top: 16,
    right: 16,
    zIndex: 1000,
    color: 'white'
  },
  hamburgerMenu: {
    position: 'absolute',
    top: 60,
    right: 0,
    width: 250,
    backgroundColor: '#222',
    color: 'white',
    padding: 20,
    borderLeftWidth: 2,
    borderLeftColor: '#444',
    zIndex: 999
  },
  menuList: {
    padding: 0
  },
  menuItem: {
    marginVertical: 15
  },
  menuLink: {
    color: 'white',
    fontWeight: 'bold'
  },
  menuLinkHover: {
    color: '#FFD700'
  },
  body: {
    flex: 1,
    backgroundColor: '#1f1f1f',
    color: 'white'
  },
  header: {
    backgroundColor: 'gold',
    padding: 10,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center'
  },
  logo: {
    height: 50,
    width: 50,
    resizeMode: 'contain'
  },
  nav: {
    flexDirection: 'row',
    alignItems: 'center'
  },
  navText: {
    color: 'black',
    fontSize: 16,
    fontWeight: 'bold',
    marginLeft: 10
  },
  authForm: {
    maxWidth: 400,
    alignSelf: 'center',
    marginTop: 50,
    padding: 20,
    backgroundColor: '#1e1e1e',
    borderRadius: 10,
    color: '#fff',
    shadowColor: '#FFD700',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.3,
    shadowRadius: 4,
    elevation: 5
  },
  formInput: {
    width: '100%',
    padding: 10,
    marginVertical: 10,
    borderRadius: 5,
    backgroundColor: '#2a2a2a',
    color: '#fff'
  },
  formButton: {
    width: '100%',
    backgroundColor: 'gold',
    color: 'black',
    padding: 10,
    borderRadius: 5,
    fontWeight: 'bold',
    textAlign: 'center'
  },
  formButtonText: {
    color: 'black',
    fontWeight: 'bold',
    textAlign: 'center'
  },
  authError: {
    color: 'red',
    fontSize: 12,
    textAlign: 'center',
    marginBottom: 10
  },
  authLink: {
    textAlign: 'center',
    marginTop: 10,
    fontSize: 12
  },
  authLinkText: {
    color: 'gold',
    textDecorationLine: 'underline'
  },
  footer: {
    backgroundColor: 'gold',
    textAlign: 'center',
    padding: 10,
    marginTop: 'auto',
    color: 'black'
  },
  footerText: {
    color: 'black',
    textAlign: 'center'
  }
});

export default styles;
