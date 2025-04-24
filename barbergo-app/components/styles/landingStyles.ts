import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  container: {
    backgroundColor: '#1c1c1c',
    padding: 16,
    flex: 1,
  },
  header: {
    backgroundColor: '#d4af37',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    padding: 16,
    borderRadius: 10,
  },
  logo: {
    height: 60,
    width: 100,
    resizeMode: 'contain',
  },
  link: {
    color: '#1c1c1c',
    fontWeight: 'bold',
    fontSize: 16,
  },
  promocional: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'center',
    gap: 16,
    paddingVertical: 24,
  },
  elementorBox: {
    backgroundColor: '#2c2c2c',
    padding: 16,
    borderRadius: 8,
    maxWidth: 300,
    margin: 8,
  },
  elementorTitle: {
    color: '#d4af37',
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 6,
    textAlign: 'center',
  },
  elementorText: {
    color: '#fff',
    textAlign: 'center',
  },
  services: {
    paddingVertical: 32,
    alignItems: 'center',
  },
  servicesTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#fff',
    marginBottom: 20,
  },
  serviceList: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'center',
    gap: 20,
  },
  serviceItem: {
    backgroundColor: '#2c2c2c',
    padding: 16,
    borderRadius: 10,
    maxWidth: 250,
    marginBottom: 16,
  },
  serviceImage: {
    width: '100%',
    height: 150,
    borderRadius: 8,
    marginBottom: 8,
  },
  serviceTitle: {
    color: '#d4af37',
    fontWeight: 'bold',
    fontSize: 16,
    marginBottom: 4,
  },
  serviceDesc: {
    color: '#fff',
  },
  mapSection: {
    paddingVertical: 24,
    alignItems: 'center',
  },
  mapLink: {
    color: '#d4af37',
    textDecorationLine: 'underline',
    fontWeight: 'bold',
    marginTop: 10,
  },
  footer: {
    backgroundColor: '#d4af37',
    padding: 16,
    alignItems: 'center',
    marginTop: 24,
    borderRadius: 10,
  },
  footerText: {
    color: '#1c1c1c',
    fontWeight: 'bold',
  },
});

