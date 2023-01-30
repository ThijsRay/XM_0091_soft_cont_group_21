# Requirements
- kubernetes
- helm

# Installation
Before you install anything, make sure that the values in `values.yaml` are correct for the platform. If you run on GKE then you might need to adjust some values.

0. (Optional) if running in minikube enable the ingress
```
minikube addons enable ingress
```

1. Install cert-manager
```
helm install \
  cert-manager jetstack/cert-manager \
  --namespace cert-manager \
  --create-namespace \
  --version v1.11.0 \
  --set installCRDs=true
```

2. Install socon
```
helm install socon .
```

# Maintainance
3. Upgrading socon
If you make changes to the yaml files, you can do
```
helm upgrade socon .
```

4. You can also rollback with
```
helm rollback socon
```
