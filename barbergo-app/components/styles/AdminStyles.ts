import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  container: {
    padding: 20,
    backgroundColor: '#1f1f1f',
    flexGrow: 1,
  },
  header: {
    backgroundColor: 'gold',
    padding: 10,
    marginBottom: 20,
    borderRadius: 8,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  headerText: {
    fontSize: 18,
    fontWeight: 'bold',
    color: 'black',
  },
  title: {
    fontSize: 20,
    fontWeight: 'bold',
    color: 'white',
    marginVertical: 10,
  },
  chart: {
    marginVertical: 8,
    borderRadius: 16,
  },
  footer: {
    backgroundColor: 'gold',
    padding: 10,
    marginTop: 30,
    alignItems: 'center',
    borderRadius: 8,
  },
  menuOverlay: {
    flex: 1,
    backgroundColor: 'rgba(0,0,0,0.5)',
    justifyContent: 'center',
    alignItems: 'center',
  },
  menuContainer: {
    backgroundColor: '#fff',
    borderRadius: 10,
    padding: 20,
    width: '80%',
  },
  menuItem: {
    paddingVertical: 10,
  },
  menuText: {
    fontSize: 18,
    color: '#333',
    fontWeight: 'bold',
  },
  menuIconRight: {
    marginRight: 10,
  },
  
  hamburgerMenuRight: {
    position: 'absolute',
    top: 70,
    right: 10,
    backgroundColor: '#fff',
    borderRadius: 8,
    padding: 10,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
    zIndex: 1000,
  },
  
  footerText: {
    color: 'black',
    fontWeight: 'bold',
  },
});
